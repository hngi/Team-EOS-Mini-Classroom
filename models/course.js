var mongoose   = require("mongoose");

var courseSchema = new mongoose.Schema({
    name: String,
    price: String,
    image: String,
    description: String,
    material: String,
    dateCreated: { type: Date, default: Date.now }, 
    author: { 
        id: {
            type: mongoose.Schema.Types.ObjectId,
            ref: "User"
        }, 
        username: String,
        fullname: String
    },
    comments: [
        {
            type: mongoose.Schema.Types.ObjectId,
            ref: "Comment"
        }
    ]
});

module.exports = mongoose.model("Course", courseSchema);
