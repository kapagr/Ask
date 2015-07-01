function name_validator(id)
    {
                name=document.getElementById("name").value;
                if (name!="")
                if(/[^a-zA-Z ]/.test(name))
                {    
                    document.getElementById("name").value="";
                    document.getElementById("name").placeholder="Alphabets ONLY!";                    
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
        num=document.getElementById("rollno").value;
        var length=num.length;
        if (isNaN(num))
        {
            document.getElementById("rollno").value="";
            document.getElementById("rollno").placeholder="Numbers ONLY!";                    
        }
        else if (length!=9)
        {
            document.getElementById("rollno").value="";
            document.getElementById("rollno").placeholder="Exactly 9 Digits";                    
        }
    }
     function fidvalidator()
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