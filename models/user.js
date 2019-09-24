var mongoose   = require("mongoose");
var passportLocalMongoose = require("passport-local-mongoose");

var UserSchema = new mongoose.Schema({
    fullname: String,
    username: String,
    password: String,
    position: String
}); 

UserSchema.plugin(passportLocalMongoose); //passportLocalMongoose plugin goes into the user.js model
module.exports = mongoose.model("User", UserSchema);