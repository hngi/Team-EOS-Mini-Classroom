var Course = require("../models/course");
var Comment = require("../models/comment");
// all the middleware goes here
var middlewareObj = {};

middlewareObj.checkCourseOwnership = function(req, res, next){
        //is user logged in
    if(req.isAuthenticated()){
        Course.findById(req.params.id, function(err, foundCourse){
                if(err){
                    req.flash("error", "Course not found");
                    res.redirect("back");
                } else{
                //does the user own the campround?
                    if(foundCourse.author.id.equals(req.user._id)){
                        next();
                    }else{
                        req.flash("error", "you dont have permission to do that ");
                        res.redirect("back");
                    }    
                }
            });
        }else{
            req.flash("error", "You need to be logged in to do that");
            res.redirect("back");
        }
    }


middlewareObj.checkCommentOwnership = function(req, res, next){
        //is user logged in
        if(req.isAuthenticated()){
            Comment.findById(req.params.comment_id, function(err, foundComment){
                if(err){
                    res.redirect("back");
                } else{
                //does the user own the comment?
                    if(foundComment.author.id.equals(req.user._id)){
                        next();
                    }else{
                        req.flash("error", "You need permission to do that");
                        res.redirect("back");
                    }    
                }
            });
        }else{
            req.flash("error", "You need to be logged in to do that");
            res.redirect("back");
        }
    }


middlewareObj.isLoggedIn = function(req, res, next){
        if(req.isAuthenticated()){
            return next();
        }
        req.flash("error", "You need to be logged in to do that");
        res.redirect("/login");
    }
    

module.exports = middlewareObj