function rawurlencode (str) {
    str = (str + '').toString();
    return encodeURIComponent(str).replace(/!/g, '%21').replace(/'/g, '%27').replace(/\(/g, '%28').
    replace(/\)/g, '%29').replace(/\*/g, '%2A');
}
function rawurldecode (str) {
    return decodeURIComponent(str + '');
}

$.domReady(function ()
{
    $('#btn_short').on('click', function(e)
    {
        e.preventDefault();
        // or via attr var url = ($('#long_url').attr('value'));
        var url = ($('#long_url').val());
        if(url.length != 0)
        {
            $.ajax({
                url: '/short/',
                type: 'json',
                method: 'post',
                data: { url: rawurlencode(url) },
                success: function (resp)
                {
                    // or via attr $('#short_url').attr('value',resp.tiny);
                    $('#long_url').val(rawurldecode(resp.url));
                    $('#short_url').val(rawurldecode(resp.tiny));
                    $('#lbl_short_url').html('CTRL+C to copy');
                    $('#short_url').focus();
                    //why this $('#short_url').select(); not work?
                },
                failure: function () {}
            });
        }
        else
        {
            $('#short_url').val('');
        }
    });    
});