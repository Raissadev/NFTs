String.prototype.reverse = function()
{
    return this.split('').reverse().join('');
};

function coinMask(field, event)
{
    var key = (!event) ? window.event.keyCode : event.which;
    var value = field.value.replace(/[^\d]+/gi, '').reverse();
    var result = "";
    var mask = "##.###.###,##".reverse();
    for(var x = 0, y = 0; x < mask.length && y < value.length;){
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

