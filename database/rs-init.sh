#!/bin/bash

DELAY=30

sleep 10

mongo --host mongo-node1:27017 <<EOF
var config = {
    "_id": "rs0",
    "version": 1,
    "members": [
        {
            "_id": 0,
            "host": "mongo-node1:27017",
            "priority": 2
        },
        {
            "_id": 1,
            "host": "mongo-node2:27017",
            "priority": 0
        },
        {
            "_id": 2,
            "host": "mongo-node3:27017",
            "priority": 0
        }
    ]
};
rs.initiate(config, { force: true });
EOF

echo "****** Waiting for ${DELAY} seconds for replicaset configuration to be applied ******"

sleep $DELAY

mongo --host mongo-node1:27017 < /database/init.js
