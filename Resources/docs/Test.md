How to test AWS SES e-mails sending
===================================

To test the working of this mechanism on your local machine you have to use a tunneling app.
Follow the instructions [here](https://blogs.aws.amazon.com/php/post/Tx2CO24DVG9CAK0/Testing-Webhooks-Locally-for-Amazon-SNS) to setup one and test the bundle.

2. Start the Symfony App

3. Start the tunnel on the same port

4. Edit the config_dev.yml file to set the new host for topics

5. Comment the lines in web/app_dev.php

5. Execute the command to create the topics and configure the database

6. 

([Go back to index](Index.md))
