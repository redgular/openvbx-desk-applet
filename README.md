openvbx-desk-applet
===================

Dependencies:
Twurl: https://github.com/marcel/twurl (which requires ruby, rubygems, make?, gcc? and the oauth gem)

To install:
In Openvbx/plugins git clone https://github.com/sinneduy/openvbx-desk-applet.git

Make sure you've authenticated in twurl with desk.  http://dev.desk.com/docs/api/tool

You'll need to make /root/.twurlrc is available to apache (or whatever user your apache instance is running under

In order to do this, I copied .twurlrc to another directory (since root isn't accessible to apache) and made apache the owner of said file

Please note that /root/.twurlrc won't exist if you haven't authenticated
