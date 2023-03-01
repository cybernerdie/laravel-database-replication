## About The Project

This is just a sample project to experiment how to setup database replication using laravel, this was achieved by creating a custom connection manager class which determines what database a read or write request is performed on. Read requests are location based, this helps to reduce latency and improve the overall user experience for users accessing the system from different regions.
