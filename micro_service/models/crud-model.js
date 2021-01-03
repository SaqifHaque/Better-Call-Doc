const db = require('./db');

module.exports = {
    getDoctors: function(callback) {
        var sql = "select * from doctors JOIN users on doctors.id=users.id";
        db.getResults(sql, function(results) {
            callback(results);
        });

    },
}