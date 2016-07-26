How to test AWS SES e-mails sending
===================================

To test the working of this mechanism on your local machine you have to use a tunneling app.
Follow the instructions [here](https://blogs.aws.amazon.com/php/post/Tx2CO24DVG9CAK0/Testing-Webhooks-Locally-for-Amazon-SNS) to setup one and test the bundle.

2. Start the Symfony App

3. Start the tunnel on the same port using Ngrok

4. Edit the config_dev.yml file to set the new host for topics

5. Comment the `if` in web/app_dev.php taht starts with `if (isset($_SERVER['HTTP_CLIENT_IP'])`

6. Execute the command to create the topics and configure the database

7. Go to Amazon AWS SNS console, select the section "Topics" and click on the created topic

8. Open a new browser window and go to the URL `http://localhost:4040/inspect/http` (this URL is used by Ngrok to show you the traffic inspections)

8. In the AWS SNS Console, click on the menu item "Request confirmation"

9. Observe the Ngrok browser window and see what happens :)

10. Come back to the Amazon SNS console and see the topic status: is it confirmed?

Test the email sending and the integration with the AWS SNS service
-------------------------------------------------------------------

The reference document is [Testing Amazon SES Email Sending](http://docs.aws.amazon.com/ses/latest/DeveloperGuide/mailbox-simulator.html).


([Go back to index](Index.md))
