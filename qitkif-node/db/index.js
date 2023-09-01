import mysql from 'mysql'
let pool;

export const db = {
    getPool: function () {
      if (pool) return pool;
      pool = mysql.createPool({
        host     : 'localhost',
        user     : 'c0db_user',
        password : 'neY!kR9GE8g',
        database : 'c0qitkif'
      });
      return pool;
    }
};
