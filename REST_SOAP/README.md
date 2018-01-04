# REST/SOAP Test Code
<p>While I am upgrading my library code to deal with REST, I need some programs to test both REST and SOAP. I want to do this thoroughly, covering all major asset types.</p>

<p>As I pointed out elsewhere, as far as the client code is concerned, there is no difference between REST and SOAP. The same program can be hooked up with either. The only requirement is that the correct version of AssetOperationHandlerService class must be selected. Other than that, everything else is the same for both.</p>

<p>Each of the programs provided here is run twice. The first time it is run using REST. Then all the changes are rolled back. And the program is run the second time using SOAP. </p>