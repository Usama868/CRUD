    /* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*Usama Taj Khan*/


 function validation()
 
{         
   var name = document.myform.Name.value;
     var fname = document.myform.fname.value;
     var uname = document.myform.user_id.value;
     var pass = document.myform.id_password.value;
     var conpass = document.myform.con_password.value;
     var email = document.myform.email_id.value;
     var address = document.myform.Address.value;
     var cont = document.myform.contact_no.value;
     var select = document.getElementById("country").value;
     var gender = document.getElementById("gender").value;
     
     
    
     
              if(name === "")
              {
               alert (" !Please Enter Name");
                document.myform.Name.focus() ;                                                                                          /*Usama Taj Khan*/
              
              return false;
                }
            
              
                
 
  
               
                  if( fname ==="")
                  { alert ("!Please Enter your father name");
                      document.myform.fname.focus() ;
                 return false;
                 
                }
                if (uname==="")
                {
                    alert("Enter User Name !!! ");
                    document.myform.user_id.focus() ;
                    return false;
                }
                if((uname.length <= 4) || (uname.length > 20))
                {
                    alert("Username lenght must be between 5 and 20");
                    return false;
                }
                if(!isNaN(uname)){
                    alert("only characters are allowed");
                    return false;
                }
                if (pass==="")
                {
                    alert("enter password!");
                    document.myform.id_password.focus() ;
                    return false;
                }
                if((pass.length <= 5) || (pass.length > 20)){
                    alert ("Passwords lenght must be between  5 and 20");
                    return false;
                }
                if (conpass ===""){                                                                                     /*Usama Taj Khan*/
                    alert("please enter confirm password");
                    document.myform.con_password.focus() ;
                    return false;
                }
                if(pass!=conpass) {
                    alert("Password does not match the confirm password");
                    return false;
                }
                
                if (email==="")
                {alert ("Enter email !!");
                    document.myform.email_id.focus() ;
                return false;
                    }
                    if(email.indexOf('@') <= 0 ){
                        alert("@ Invalid Position");
                        return false;
                        
                    }
                    if((email.charAt(email.length-4)!=='.') && (email.charAt(email.length-3)!=='.')){
                        alert (". Invalid Position");
                        return false;
                    }
                    
                    if (address==="")
                    {
                        alert("Enter your Address Please!");
                        document.myform.Address.focus() ;
                        return false;
                    }
                    if(cont==="")
                    {
                        alert("Enter your contact no!");
                        document.myform.contact_no.focus() ;
                        return false;
                    }
                    if(isNaN(cont)){
                        alert("user must write digits only not characters");
                        return false;
                    }
                    if(cont.length!==11){
                        alert("Mobile Number must be 11 digits only");
                        return false;                                                                                                   /*Usama Taj Khan*/
                    }
                   
                             if(select==="Select country"){
                             alert("please select country");
                                 return false;
                                                }
                                    
                                  
                       if(gender==="Select gender"){
                           alert("Please Select your Gender");
                           return false;
                       }
                       
     
                }







    



/*Usama Taj Khan*/                  
