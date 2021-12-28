String.prototype.reverse = function()
{
    return this.split('').reverse().join('');
};

function coinMask(field, event)
{
    let key = (!event) ? window.event.keyCode : event.which;
    let value = field.value.replace(/[^\d]+/gi, '').reverse();
    let result = "";
    let mask = "##.###.###,##".reverse();
    for(let x = 0, y = 0; x < mask.length && y < value.length;){
        if(mask.charAt(x) != "#"){
            result += mask.charAt(x);
            x++;
        }else{
            result += value.charAt(y);
            y++;
            x++;
        }
    }

    field.value = result.reverse();
}
