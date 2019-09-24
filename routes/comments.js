var express = require("../node_modules/express");
var router = express.Router({mergeParams: true});
var Course = require("../models/course");
var Comment = require("../models/comment");
var middleware = require("../middleware");

 
//COMMENTS ROUTES

router.get("/new", middleware.isLoggedIn, function(req, res){
    //find Course by id
    Course.findById(req.params.id, function(err, course){
        if(err){
            console.log(err);
        } else{
            res.render("comments/new", {course:course});
        }
    });
});

router.post("/", middleware.isLoggedIn,function(req, res){
    //LOOKUP CAMPGROUND BY ID
    Course.findById(req.params.id, function(err, course){
        if(err){
            console.log(err);
            res.redirect("/courses")
        } else{
             Comment.create(req.body.comment, function(err, comment){
                if(err){
                    req.flash("error", "Something went wrong");
                    console.log(err);
                } else{
                    // add username and id to comment
                    comment.author.id = req.user._id;
                    comment.author.username = req.user.username;
                    comment.author.position = req.user.position;
                    //save comment
                    comment.save();
                    course.comments.push(comment);
                    course.save();
                    req.flash("success", "Successfully added comment");
                    res.redirect("/courses/" + course._id);
                }
             });
        }    
    });
});

//COMMENT EDIT ROUTE
router.get("/:comment_id/edit", middleware.checkCommentOwnership, function(req, res){
    Comment.findById(req.params.comment_id, function(err, foundComment){
        if(err){
            res.redirect("back");
        }else{
            res.render("comments/edit", {course_id: req.params.id, comment: foundComment});
        }
    })
});

//comment update  route
router.put("/:comment_id", middleware.checkCommentOwnership, function(req, res){
    Comment.findByIdAndUpdate(req.params.comment_id, req.body.comment, function(err, updatedComment){
        if(err){
            res.redirect("back");
        }else{
            res.redirect("/courses/" + req.params.id);
        }
    });
});




//COMMENT DESTROY ROUTE
router.delete("/:comment_id", middleware.checkCommentOwnership, function(req, res){
    Comment.findByIdAndRemove(req.params.comment_id, function(err){
        if(err){
            res.redirect("back");
        } else{
            req.flash("success", "Comment deleted");
            res.redirect("/courses/" + req.params.id);
        }
    });
});



module.exports = router;
