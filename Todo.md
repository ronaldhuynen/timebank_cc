# TODO

- make bank and organization default profile photo 
- make bank also a messenger providerye
- csv export transaction overview (LN
- qr code payment / transfer descr etc in url)

# Questions  Joeri

- Keep username?  Login: username òf email, username zonder @. Elk uniek en samen uniek. Interface: username voorrang, dan name : Joeri45 (Joeri Oudshoorn)
- Duplicates in name field? Contact 47 users to remove duplicated
- Laravel user can change email? Username and name can not be changed.
- Keep Gift Accounts? Yes, but add is_closed logic. Can be showed in historic transaction overview (special checkbox)
- Convert locations? Set bulk manually without too much work.


Account:

Joeri45 (Joeri Oudshoorn)
    Default __('account')   

Default wordt weergegeven als in db accountnaam NULL is.
2e rekening moet je een naam geven: niet toegestaan: spatie, @   

# Questions board

- Email not confirmed in Laravel, should user be visible in Laravel?
- Ask all users to confirm email address during transition Laravel? Also passwords can then be updated
- 
- 

# account limits

Set in accounts, users, organizations tables
limit_min limit_max


User: limit_max 6000
During transaction: check limits

 




# Passwords
Cyclos:
Hi,

salt in Cyclos 3.6_RC1:

$salt ... from db
$password ... Plaintext (for example: 1234)

password_from_db = hash("sha256",$salt.$password);


I hope, that helps.
Norbert
https://forum.cyclos.org/viewtopic.php?t=857


ASK COPILOT:
I have a db with a salt and sha256 password, how import to a laravel 10 app?





# Mail

systeem mail unsubscribable
messages mail vaction timer with mail feedback to sender of message
group messages no mail
newsletter: unsubscribable  and in newsletter notification if you  have personal or group messages. You have unread mail

Out of office logic. 


