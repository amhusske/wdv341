const assert = require('chai').assert;
const recipeName = require('../app').recipeName;
const servings = require('../app').servings;
const description = require('../app').validateDescription;
const amount = require('../app').amount;
const unit = require('../app').unit;

describe('App', function(){
 it('recipeName should not be empty', function(){
     assert.isFalse(recipeName(""));
 });

 it('recipeName should be empty', function(){
    assert.isFalse(recipeName("    "));
});


// Serving validations
it('A string input should be invalid', function(){
    let result = servings("absh");
    assert.equal(result, 'not a number');
});

it('A string input should be invalid', function(){
    let result = servings("12absh1232");
    assert.equal(result, 'not a number');
});

it('Number should pass', function(){
    let result = servings(3);
    assert.equal(result, 'thanks');
});

it('cannot be empty', function(){
    let result = servings("");
    assert.equal(result, 'enter a serving');
});

it('special characters wont pass', function(){
    let result = servings("#$");
    assert.equal(result, 'not a number');
});

//Description
it('Not longer than 40 characters', function(){
    let result = description("qwejjdhfhbqwejjdhfhbqwejjdhfhbqwejjdhfhbbbkbdx");
    assert.equal(result, 'too long');
});

it('Cannot be empty', function(){
    let result = description("");
    assert.equal(result, 'enter description');
});

// amount
it('Should be false', function(){;
    assert.isFalse(amount("abdj"));
});

it('number', function(){
    assert.isFalse(amount(""));
});

it('not a number', function(){
    assert.isFalse(amount("abf244566"));
});


});