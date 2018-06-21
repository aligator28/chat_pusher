function notifyMe() {
  // Проверка поддержки браузером уведомлений
  if (!("Notification" in window)) {
    alert("This browser does not support desktop notification");
  }

  // Проверка разрешения на отправку уведомлений
  else if (Notification.permission === "granted") {
    // Если разрешено, то создаем уведомление
    var notification = new Notification("Hi there!");


  }

  // В противном случае, запрашиваем разрешение
  else if (Notification.permission !== 'denied') {
    Notification.requestPermission(function (permission) {
      // Если пользователь разрешил, то создаем уведомление 
      if (permission === "granted") {
        var notification = new Notification("Hi there!");
      }
    });
  }

  // В конечном счете, если пользователь отказался от получения 
  // уведомлений, то стоит уважать его выбор и не беспокоить его 
  // по этому поводу.
}

                
                // $.ajax({
                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     },
                //     method: "post",
                //     url: "/message",
                //     data: { message: $('#fff').find("#message").val() },
                //     contentType: "text/html;charset=UTF-8",
                //     dataType: "json"
                // })
                // .done( function( msg ) {
                //     console.log(msg);
                // });