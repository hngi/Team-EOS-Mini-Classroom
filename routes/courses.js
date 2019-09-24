var express = require("express");
var router = express.Router();
var Course = require("../models/course"); 
var middleware = require("../middleware");



// INDEX ROUTE = show all Courses
router.get("/", function(req, res){
    //get all Courses from db
    Course.find({}, function(err, allCourses){
        if (err){
            console.log(err);
        } else {
            res.render("courses/index", {courses: allCourses, currentUser: req.user});
        }
    });
});

// CREATE ROUTE = add new Course in DB
router.post("/", middleware.isLoggedIn, function(req, res){
    // get data from form and add to Course array
    var name  = req.body.name;
    var price = req.body.price;
    var image = req.body.image;
    var desc  = req.body.description;
    var material  = req.body.material;
    var author = {
        id: req.user._id,
        username: req.user.username,
        fullname: req.user.fullname
    }
    var newCourse = {name: name, price: price, image: image, description: desc, material : material ,author: author};
    // create new Course and save to db
    Course.create(newCourse, function(err, newlyCreated){
        if (err){
            console.log(err);
        } else {
            //redirect to /courses page
            res.redirect("/courses");
        }
    });
});

//NEW ROUTE = show form to creat new course
router.get("/new", middleware.isLoggedIn, function(req, res){
    res.render("courses/new");
})

//SHOW ROUTE = SHOWS DETAILS OF A course
router.get("/:id", function(req, res){
    //find the course with provided ID
    Course.findById(req.params.id).populate("comments").exec(function(err, foundCourse){
        if(err){
            console.log(err);
        } else{
            // console.log(foundcourse);
            res.render("courses/show", {course: foundCourse });
        }
    });
});
// EDIT course ROUTES
router.get("/:id/edit", middleware.checkCourseOwnership, function(req, res){
    Course.findById(req.params.id, function(err, foundCourse){
        req.flash("error", "course not found");
        res.render("courses/edit", {course: foundCourse});
    });
});
//UPDATE CAMPROUND ROUTES
router.put("/:id", middleware.checkCourseOwnership,  function(req, res){
    //find and update the corect course
    Course.findByIdAndUpdate(req.params.id, req.body.course, function(err, updatedCourse){
        if(err){
            res.redirect("/courses");
        } else{
            //redirect to show page
            res.redirect("/courses/" + req.params.id);
        }
    });
});

//destroy course route
router.delete("/:id", middleware.checkCourseOwnership, function(req, res){
    Course.findByIdAndRemove(req.params.id, function(err){
        if(err){
            res.redirect("/courses");
        } else{
            res.redirect("/courses");
        }
    })
});

// function checkCourseOwnership (req, res, next){
//     //is user logged in
// if(req.isAuthenticated()){
//     Course.findById(req.params.id, function(err, foundCourse){
//             if(err){
//                 res.redirect("back");
//             } else{
//             //does the user own the campround?
//                 if(foundCourse.author.id.equals(req.user._id)){
//                     next();
//                 }else{
//                     res.redirect("back");
//                 }    
//             }
//         });
//     }else{
//         res.redirect("back");
//     }
// }

// function isLoggedIn(req, res, next){
//     if(req.isAuthenticated()){
//         return next();
//     }
//     res.redirect("/login");
// }

module.exports = router;