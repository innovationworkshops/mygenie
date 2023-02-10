
let id = $("input[name*='lead_id']")
id.attr("readonly","readonly");


$(".btnedit").click( e =>{
    let textvalues = displayData(e);

    ;
    let email = $("input[name*='email']");
    let last_name = $("input[name*='last_name']");
    
    
    let deviceId = $("input[name*='deviceId']");
    let eventId = $("input[name*='eventId']");
    let dateTimefield = $("input[name*='dateTimefield']");
    let eventType = $("input[name*='eventType']");
    let category = $("input[name*='category']");
    let sessionId = $("input[name*='sessionId']");
    
    let first_name = $("input[name*='first_name']");
    
    

    id.val(textvalues[0]);
    email.val(textvalues[1]);
    last_name.val(textvalues[2]);
    
    deviceId.val(textvalues[3]);
    eventId.val(textvalues[4]);
    dateTimefield.val(textvalues[5]);
    eventType.val(textvalues[6]);
    category.val(textvalues[7]);
    sessionId.val(textvalues[8]);
    
    first_name.val(textvalues[9].replace("", ""));
});


function displayData(e) {
    let id = 0;
    const td = $("#tbody tr td");
    let textvalues = [];

    for (const value of td){
        if(value.dataset.id == e.target.dataset.id){
           textvalues[id++] = value.textContent;
        }
    }
    return textvalues;

}
