var state="menu";
function disp()
{
    console.log(state);
    var shop = document.getElementById("shop");
    var user = document.getElementById("user");
    var market = document.getElementById("market");
    var players = document.getElementById("players");    
    var signout = document.getElementById("signout");    
    shop.style.display="block";
    user.style.display="block";
    market.style.display="block";
    if(state=="menu")
        players.style.display="block";
    else
        players.style.display="none";
    signout.style.display="block";
    
}
function trans()
{
    state="nav";
    console.log(state);    
    var main = document.getElementById("main");    
    var shop = document.getElementById("shop");
    var user = document.getElementById("user");
    var market = document.getElementById("market");
    var logout = document.getElementById("signout");
    var players = document.getElementById("players");
    main.className = "butto-main";
    shop.className = "butto-shop";
    user.className = "butto-user";
    market.className = "butto-market ";
    logout.className = "butto-logout ";   
    players.style.display = "none"; 
}
function rev_trans()
{
    state="menu";
    console.log(state);    
    var main = document.getElementById("main");    
    var shop = document.getElementById("shop");
    var user = document.getElementById("user");
    var market = document.getElementById("market");
    var players = document.getElementById("players");
    var logout = document.getElementById("signout");
    main.className = "main";
    shop.className = "shop";
    user.className = "user";
    market.className = "market";
    players.className = "players";
    logout.className = "signout";
    players.style.display = "block"; 
}


