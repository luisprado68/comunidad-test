console.log('test');
let stream_active = false;
let actual = new Date();
let hour_actual = actual.getHours();
let times = JSON.parse(document.getElementById('times').value);
console.log(times);
times.forEach(element => {
    console.log(element);
    if (hour_actual == element) {
        stream_active = true;
    }
});

if (stream_active) {
    const id = setInterval(() => {
        current = new Date();
        var hour = current.getHours();
        var minute = current.getMinutes();
        console.log(hour + ':' + minute);

        if (minute >= 50 && minute <= 55) {
            console.log('entro');
            clearInterval(id);


            $.ajax({
                url: 'chatters',
                type: "GET",

                success: function(response) {
                    console.log(response);

                    if (response.status === 'ok') {
                        // $("#edit-dialog").modal("hide");
                        // table.draw();
                        console.log('okkkk');
                        console.log(response);
                        location.reload()
                    } else if (response.status === 'error') {
                        console.log('error');
                        // window.alert(response.message);
                        // window.location.href = "{{ route('schedule') }}";
                        location.reload()
                    }
                    // $(".loading").hide();
                },
                error: function(data) {

                }
            });



        }

    }, 60000);
}