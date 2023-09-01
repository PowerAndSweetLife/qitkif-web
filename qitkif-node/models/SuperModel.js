import { db } from '../db/index.js';
export default class SuperModel {
    constructor(table) {
        this.table = table;
        this.pool = db.getPool();
    }
    all(order=null) {
        let query = `SELECT * FROM ${this.table}`;
        if(order) {
            query += " ORDER BY ";
            let i = 0;
            for(let key in order) {
                if(i > 0) {
                    query += ","
                }
                query += `${key} ${order[key]}`
                i++;
            }
        }
        return new Promise((resolve, reject) => {
            this.pool.query(query, (err, results) => {
                if(err) {
                    reject(err)
                    return false;
                }
                resolve(results)
            })
        }) 
    }
    async findOneBy(data) {
        const result = await this._find(data,false);
        return result;
    }
    async findBy(data) {
        const result = await this._find(data,true);
        return result;
    }
    async findById(id) {
        const result = await this._find({id: id}, false);
        return result;
    }
    _find(data, all)
    {
        let condition = "";
        let values = [];
        let i=0
        for(let k in data)
        {
            if(i === 0 ) {
                condition += `${k}=?`;
            }
            else {
                condition += ` AND ${k}=?`;
            }
            values.push(data[k]);
            i++;
        }
        
        return new Promise((resolve, reject) => {
            this.pool.query(`SELECT * FROM ${this.table} WHERE ${condition}`,values, (err, results) => {
                if(err) {
                    reject(err)
                    return false;
                }
                if(all) {
                    resolve(results);
                } else {
                    resolve(results[0]);
                }
                
            })
        }) 
    }
    
}