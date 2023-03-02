use runnersCrisps;

db.users.drop();
db.codes.drop();

/**
 * Function to generate a random 10-digit hex code
 * @returns String 10 digt hex code
 * https://stackoverflow.com/questions/58325771/how-to-generate-random-hex-string-in-javascript
 */

const generateCode = () => {
    return [...Array(10)].map(() => Math.floor(Math.random() * 16).toString(16)).join('');
}

/**
 * Insert some test data, with random codes and 'won football' fields.
 */

let codes = [];
codes.push(
    [
        { 
            '_id': 1234, 
            'code': 'a1b2c3d4e5', 
            'used': true, 
            'wonFootball': false 
        },
        { 
            '_id': 1235, 
            'code': 'a1b2c3d4e6', 
            'used': false, 
            'wonFootball': false 
        },
        { 
            '_id': 1235, 
            'code': 'a1b2c3d4e7', 
            'used': false, 
            'wonFootball': false 
        },
        { 
            '_id': 1236, 
            'code': 'a1b2c3d4e8', 
            'used': false, 
            'wonFootball': true 
        }
    ]
)

db.codes.insertMany(codes);
db.codes.findOne({ 'code': 'a1b2c3d4e5' })
db.users.insertOne({})