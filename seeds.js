var mongoose   = require("mongoose"),
    Campground = require("./models/course"),
    Comment    = require("./models/comment");

var data = [
    {
        name: "abuja", 
        image: "https://farm5.staticflickr.com/4042/4348094406_3ce30a0fd7.jpg",
        description: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.This is a nice place to hang out with family and frinds for a good time to reconnect withe the ones we love!!"
    },
    {
        name: "abuja", 
        image: "https://farm5.staticflickr.com/4042/4348094406_3ce30a0fd7.jpg",
        description: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.This is a nice place to hang out with family and frinds for a good time to reconnect withe the ones we love!!"
    },
    {
        name: "abuja", 
        image: "https://farm5.staticflickr.com/4042/4348094406_3ce30a0fd7.jpg",
        description: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.This is a nice place to hang out with family and frinds for a good time to reconnect withe the ones we love!!"
    }
]

function seedDB(){
    // remove all comments
    Comment.deleteMany({}, function(err){
        if(err){
            console.log(err)
        } else{
            console.log("comments DB removed")
        }
    });
    //remove all campgrounds
    Campground.deleteMany({}, function(err){
        if(err){
            console.log(err);
        }
        console.log("campgrounds db removed");
        //add a few campgrounds
        data.forEach(function(seed){
            Campground.create(seed, function(err, campground){
                if(err){
                console.log(err);
                } else{
                    console.log("new campgreound created");
                    
                    //add a few coment
                    Comment.create({
                        text: "i have been to this place and it is alsome",
                        author: "Emeka"
                    }, function(err, comment){
                        if(err){
                            console.log(err);
                        } else{
                            campground.comments.push(comment);
                            campground.save();
                          

                            console.log("created comment");
                        }                        
                    });  
                }
            });
        }) 
    });   
    
}

module.exports = seedDB;