var express   = require("../node_modules/express");
var router    = express.Router();
var passport  = require("../node_modules/passport/lib");
var User      = require("../models/user");

router.get("/", function(req, res){
    res.render("landing");
});

//================== 
//AUTH routes
//=============

// show register form
router.get("/register", function(req, res){
    res.render("register")
})
router.get("/register2", function (req, res) {
    res.render("register2")
})

// handle signup logic 
// here the user gets created and then the user is logged in with passport.authticate(a passport-local-mongoose object)
router.post("/register", function(req, res){
    var newUser = new User({fullname: req.body.firstname+' '+req.body.lastname,username: req.body.username, position: req.body.position});
    User.register(newUser, req.body.password, function(err, user){
        if(err){
            console.log(err);
            // req.flash("error", err.message);
            return res.render("register", {error: err.message})
        }
        passport.authenticate("local")(req, res, function(){
            req.flash("success", "Welcome to Mathisi " + user.username);
            res.redirect("/courses");
        });
    });
});

// router.post("/register2", function (req, res) {
//     var newUser = new User({ fullname: req.body.firstname + ' ' + req.body.lastname, username: req.body.username, position: req.body.position });
//     User.register(newUser, req.body.password, function (err, user) {
//         if (err) {
//             console.log(err);
//             // req.flash("error", err.message);
//             return res.render("register2", { error: err.message })
//         }
//         passport.authenticate("local")(req, res, function () {
//             req.flash("success", "Welcome to Mathisi " + user.username);
//             res.redirect("/courses");
//         });
//     });
// });

// login Route
//show login form
router.get("/login", function(req, res){
    res.render("login");
});

// handling the login logic
router.post("/login", passport.authenticate("local", 
{
    successRedirect: "/courses",
    failureRedirect: "/login",
    failureFlash: true,
}), function(req, res){
    
});

//LOG OUT ROUTE
router.get("/logout", function(req, res){
    req.logOut();
    req.flash("success", "Logged you out")
    res.redirect("/");
});

//about routtrs
router.get("/about", (req, res) => {
    res.render("about")
});

//getstarted routes
router.get("/getstarted", (req, res) => {
    res.render("getstarted")
});
module.exports = router;