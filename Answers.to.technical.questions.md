How long did you spend on the coding test? What additional features would you consider implementing if you had more time?
Ans: There are alot of features that I would like to implement if I have more time: 
- Translations (property , geo)
- Property Galleries 
- Inquiry & Conact Email
- Currency Exchange (optional)

- Authentication (User or Property Owner, etc)
- Backend Implementation (Customize CRUD for properties)
- Roles & Permissions 
- DB Design & Table Normalization (properties gallery , lattitude & longitude, country|province|district|subdirct translation)

Describe a security best practice you would implement in this application to protect the API.
Explain how you would approach optimizing the performance of the API for handling large amounts of property data.
ANS: 

To protect the API & data, I have to implement Authorization & Authentication for each API using
- Laravel Passport
- Laravel Sanctum
- any others token-based authentication

To handle the large amounts of property data, we need to check
- Query optimization (Relationship between models - Eager loading)
- Partitioning the database - If we will have alot of properies data day by day , we need to consider the parition the database by date or month or province
- Caching the query and api response data 
- Backgroud Jobs 
- Monitoring and Profiling - we need to monitor performance and identify bottlenecks by using Laravel Telescope or others mornitoring tools
- Code Optimization & Refactoring - it is important to handle the performance of large data
- Elastich Search - To search and store the data and response back the data in milliseconds.

How would you track down a performance issue in production? Have you ever had to do this? If so, please describe the experience.

ANS:
I have faced performance issues on production sites using Magento, Laravel, and Symfony. In these cases, we (DevOps and developers) need to check the critical errors in log files or any other monitoring tools (such as Telescope and OpenSearch). Additionally, we analyze logs, timeout errors, and environment variables on production.

Sometimes, we need to modify and optimize our complex queries. Moreover, we need to check on a staging server with the production database or environment variables. After tracking the errors, we need to test these modifications and optimizations.
