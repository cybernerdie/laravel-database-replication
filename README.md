## About The Project

This is a sample project that showcases how to work with database replication in Laravel.

To achieve this, I have created a custom connection manager class that determines whether a read or write request is performed on a specific database based on the user's location. By implementing this connection manager class in models where we need data to be readily available based on the user's location, we can reduce latency and improve the user experience for users accessing the system from different regions.

One of the significant benefits of this feature is improved data availability and reliability. Database replication provides redundancy, which ensures that data is always available even in the event of a hardware failure or other outage. It also helps to improve data reliability by reducing the risk of data loss due to hardware or software failure.

Overall, this project serves as a great example of how Laravel's database replication feature can significantly improve the availability, reliability, scalability, and performance of a system.




