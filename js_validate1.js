 function name_validator(id)
    {
        switch(id)
        {
            case 1:
                name=document.getElementById("name").value;
                if (name!="")
                if(/[^a-zA-Z ]/.test(name))
                {    
                    document.getElementById("name").value="";
                    document.getElementById("name").placeholder="Alphabets ONLY!";                    
                }    
                break;
            
            case 2:
                name=document.getElementById("lnameid").value;
                if (name!="")
                if(/[^a-zA-Z ]/.test(name))
                {
                    document.getElementById("lnameid").value="";
                    document.getElementById("lnameid").placeholder="Alphabets ONLY!";                    
                }
                break;
        }       
    }
    
    function email_validator()
    {
        email=document.getElementById("email").value;
       var filter =/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            
        if (!filter.test(email))
        {
            document.getElementById("email").value="";
            document.getElementById("email").placeholder="Invalid Email ID!";                    
        }
    }
    function contact_validator()
    {
        num=document.getElementById("phone").value;
        var length=num.length;
        if (isNaN(num))
        {
            document.getElementById("phone").value="";
            document.getElementById("phone").placeholder="Numbers ONLY!";                   
        }
        else if (length!=10)
        {
            document.getElementById("phone").value="";
            document.getElementById("phone").placeholder="Exactly 10 Digits";                    
        }
    }
    function rollnovalidator()
    {
        num=document.getElementById("fid").value;
        var length=num.length;
        if (isNaN(num))
        {
            document.getElementById("fid").value="";
            document.getElementById("fid").placeholder="Numbers ONLY!";                    
        }
        else if (length!=10)
        {
            document.getElementById("fid").value="";
            document.getElementById("fid").placeholder="Exactly 10 Digits";                    
        }
    }
    function usernamevalid()
    {
        username=document.getElementById("username").value;
       var filter = username.length;
            
        if (filter!=10)
        {
            document.getElementById("username").value="";
            document.getElementById("username").placeholder="Exactly 10 characters!";                    
        }
    }
     function passwordvalid()
    {
        num=document.getElementById("password").value;
        var length=num.length;
        if (length!=10)
        {
            document.getElementById("password").value="";
            document.getElementById("password").placeholder="Exactly 10 Digits";                    
        }
    }
    function repasswordvalid()
    {
        username=document.getElementById("repassword").value;
        username1=document.getElementById("password").value;
        var filter = username.length;
        if(username1!=username)
        {
             document.getElementById("repassword").value="";
            document.getElementById("repassword").placeholder="Password Not Match!";
        }
    }