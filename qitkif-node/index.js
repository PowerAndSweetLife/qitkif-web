import axios from 'axios';
import express from 'express';
import Offre from './models/Offre.js';

const app = express()
const port = 3000
const api_url = (uri) => {
  return `https://qitkif.com/api/${uri}`
}

const API_KEY = "jhK5F743Q61#";
const AXIOS_POST_CONFIG = {
  headers: {
    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
  },
};

/**
 * Timeout
 */
const timeout = {
  CONTRE_PROPOSITION : 1800 * 1000, // 30 minutes
  ACTIVE_PAIEMENT : 1800 * 1000, // 30 minutes
  PAIEMENT : 1800 * 1000, // 30 minutes
  WAIT_VALIDATION : 1800 * 1000 // 30 minutes
  //TEST : 60000,
}

app.use(express.json());

app.post("/offreObserver", (req, res) => {
  const idOffre = req.body.idOffre;
  const state = req.body.state;
  const action = req.body.action;
  const offreModel = new Offre('offre');

  console.log("offre observed... " + idOffre);
  
  let duration;
  if(action === "contre_proposition") {
    duration = timeout.CONTRE_PROPOSITION;
  } else if(action === "paiement") {
    duration = timeout.PAIEMENT;
  } else if(action === 'active_paiement') {
    duration = timeout.ACTIVE_PAIEMENT
  } else if(action === 'wait_validation') {
    duration = timeout.WAIT_VALIDATION
  }
  else {
    duration = Number(req.body.duration) * 3600 * 1000;
  }

  const t = setTimeout(async () => {
    const result = await offreModel.findById(idOffre);
    if(Number(result.etat) === Number(state)) {
      axios.post(api_url('offreExpired'), {idOffre: idOffre, key: API_KEY}, AXIOS_POST_CONFIG)
        .then(res => {
          console.log(res.data);
        })
        .catch(err => {
          console.log(err.response);
        })
      clearTimeout(t);
    } else {
      clearTimeout(t);
    }

  }, duration);

  res.send({initialized: true});
});

// app.post("/test",(req,res) => {
//   console.log("mandeha");
//   res.send({response: "OK"});
// })

app.listen(port, () => {
  console.log(`====Example app listening on port==== ${port}`)
})
