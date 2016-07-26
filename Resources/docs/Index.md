AWS SES Monitor Bundle Documentation
====================================

Using the bundle is really simple and in a matter of minutes you'll be able to manage bounces and complaints of e-mails sent through AWS SES.

The first step is to install the bundle, then you have to configure it and finally you have to create the appropriate topics on AWS SNS (through Symfony's console) and subscribe your app to them (automatically handled by the bundle).

After you have done this, your app will automatically manage bounces and complaints and your AWS SES account will be safe and never deactivated by Amazon.

1. [Install and activate the bundle](Installation.md)
2. [Configure the bundle](Configuration.md)
3. [Configure AWS SES through Symfony's Console](Integration.md)
4. [Test the sending of e-mails](Test.md)

Other useful resources about AWS SES
------------------------------------

* [AWS Simple Email Service Developer guide](http://docs.aws.amazon.com/ses/latest/DeveloperGuide/Welcome.html)
    * [Processing bounces and complaints](http://docs.aws.amazon.com/ses/latest/DeveloperGuide/best-practices-bounces-complaints.html)
    * [Using Notifications with Amazon SES](http://docs.aws.amazon.com/ses/latest/DeveloperGuide/notifications.html)
    * [Amazon SES Notifications Through Amazon SNS](http://docs.aws.amazon.com/ses/latest/DeveloperGuide/notifications-via-sns.html)
    * [Testing Amazon SES Email Sending](http://docs.aws.amazon.com/ses/latest/DeveloperGuide/mailbox-simulator.html)
* [AWS Simple Email Service Blog](http://sesblog.amazon.com/)
    * [Handling bounces and complaints](http://sesblog.amazon.com/post/TxJE1JNZ6T9JXK/-Handling-span-class-matches-Bounces-span-and-Complaints.pdf)
* [AWS Simple Email Service Forum](https://forums.aws.amazon.com/forum.jspa?forumID=90)

Other useful resources about AWS SNS
------------------------------------

* [AWS Simple Notification Service Developer guide](http://docs.aws.amazon.com/sns/latest/dg/welcome.html)
* [AWS Simple Notification Service Blog](https://aws.amazon.com/it/blogs/aws/category/amazon-sns/)
* [AWS Simple Notification Service Forum](https://forums.aws.amazon.com/forum.jspa?forumID=72)
