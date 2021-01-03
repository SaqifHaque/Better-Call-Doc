const express = require('express');
const userModel = require.main.require('./models/crud-model');
const router = express.Router();

router.get('/search/:str', (req, res) => {
        userModel.getDoctors(function(results) {
            const result = results.filter(doc => doc.name.toLowerCase().includes(req.params.str.toLowerCase()) ||
                doc.specilization.toLowerCase().includes(req.params.str.toLowerCase()) ||
                doc.email.toLowerCase().includes(req.params.str.toLowerCase())
            );
            console.log(result);
            res.send(JSON.stringify(result));
        })
});
module.exports = router;