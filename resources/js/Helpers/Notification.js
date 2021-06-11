class Notification{

    success(){
        new Noty({
            type : 'success',
            layout: 'topRight',
            text: 'Berjaya!',
            timeout: 1000,
        }).show();

    }
    Imagesuccess(){
        new Noty({
            type : 'success',
            layout: 'topRight',
            text: 'Imej telah dimuat naik!',
            timeout: 1000,
        }).show();

    }
    alert(){
        new Noty({
            type : 'alert',
            layout: 'topRight',
            text: 'Are you sure?',
            timeout: 1000,
        }).show();

    }
    error(){
        new Noty({
            type : 'alert',
            layout: 'topRight',
            text: 'Something went wrong!',
            timeout: 1000,
        }).show();

    }

    warning(){
        new Noty({
            type : 'warning',
            layout: 'topRight',
            text: 'Warning! This will delete data',
            timeout: 1000,
        }).show();

    }
    unauthorized(){
        new Noty({
            type : 'error',
            layout: 'topRight',
            text: 'Unauthorized access!',
            timeout: 1000,
        }).show();

    }
    image_validation(){
        new Noty({
            type : 'error',
            layout: 'topRight',
            text: 'Error: Image larger than 1MB!',
            timeout: 1000,
        }).show();

    }
    wrong(){
        new Noty({
            type : 'error',
            layout: 'topRight',
            text: 'Something went wrong!',
            timeout: 1000,
        }).show();

    }
   }
   
   export default Notification = new Notification()