const { MongoClient } = require("mongodb");

let dbConnection;
let uri = "mongodb+srv://zulkifli1814:<password>@cluster0.nbwolps.mongodb.net/";
module.exports = {
  connectTodb: (cb) => {
    MongoClient.connect(uri)
      .then((client) => {
        dbConnection = client.db();
        return cb();
      })
      .catch((err) => {
        console.log(err);
        return cb(err);
      });
  },
  getDb: () => dbConnection,
};
