# Authentication

---

User fingerprinting for Laravel.  This is really just put together for blade based applications, but can be extended to
other ecosystems pretty easily by posting the appropriate fingerprint data to the fingerprint route.

### Why?  
In multiple applications, we needed a way to track users pre/post auth without a moderate level of accuracy.  
We use this for a paywall, and as part of an auth check to see if a user has authenticated by a device before.  

### How to install?

Add this directive to any page where you might want to initiate tracking a fingerprint, ie. login pages.
```
@fingerprint
```
Once this is on a page, it takes a fingerprint of the user's browser, courtesy of FingerprintJS.  That data is then
sent to the server, which is adds to the user's session ( variable named fingerprint ) and then triggers an event.  You 
can then put a listener on the event to do with the data as needed.  

Listen to the event
```
Crumbls\Fingerprint\Events\Fingerprint
```
On firing, this event emits the fingerprint, the IP address, and the user, if available.

This can use a lot of improvement, but is a good starting point for these use cases.

## Credits

- [Chase C. Miller](https://github.com/chasecmiller)

## License

Copyright &copy; 2022 Chase C. Miller.  All Rights Reserved.