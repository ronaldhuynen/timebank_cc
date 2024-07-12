# TODO

!! Debug update-profile-skills-form deze is denk ik betrouwbaarder. Alles werkt, BEHALVE wanneer er een vertaling wordt gebruikt.:


context_id wordt verkeerd opgeslagen!




/home/r/Websites/timebank_cc_2
/
storage/framework/views/34fd51eb92ad59faba518213bed37f6c.php:387 {▶}

- make bank and organization default profile photo 
- csv export transaction overview (LN
- qr code payment / transfer descr etc in url)
- Amount inputs: two field: Hours and another for minutes.
- update last_login_at for banks and organizations when account is switched.
- create remove user / project / bank method 
- prevent creation of bank account when profile is not complete?  

# Questions  Joeri
- Keep Gift Accounts? Yes, but add is_closed logic. Can be showed in historic transaction overview (special checkbox)
- Convert locations? Set bulk manually without too much work.


# Profile / username
UI: username voorrang, dan name : Joeri45 (Joeri Oudshoorn)
Laravel user can change email? Username and name can not be changed.



Account:

Joeri45 (Joeri Oudshoorn)
    Default __('account')   

Default wordt weergegeven als in db accountnaam NULL is.
2e rekening moet je een naam geven: niet toegestaan: spatie, @   

# Questions board



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


