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
            req.flash("success", "Welcome to Yelpcamp " + user.username);
            res.redirect("/courses");
        });
    });
});

// login Route
//show login form
router.get("/login", function(req, res){
    res.render("login");
});

// handling the login logic
router.post("/login", passport.authenticate("local", 
{
    successRedirect: "/courses",
    failureRedirect: "/login"
}), function(req, res){
});

//LOG OUT ROUTE
router.get("/logout", function(req, res){
    req.logOut();
    req.flash("success", "Logged you out")
    res.redirect("/courses");
});

module.exports = router;