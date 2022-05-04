<script>
    function myFunction() {
        Swal.fire({
            title: 'Error!',
            text: 'Do you want to continue',
            icon: 'error',
            confirmButtonText: 'Cool'
        })
    }

function fileAlreadyExists() {
        Swal.fire({
            title: 'Documentation error: File already exists, please re-select.',
            text: '',
            icon: 'error',
            confirmButtonText: 'Ok'
        })
    }

function fileSizeError() {
        Swal.fire({
            title: 'Documentation error: File is too large, 10MB maximum per attachment.',
            text: '',
            icon: 'error',
            confirmButtonText: 'Ok'
        })
    }

    function partyTime() {
        Swal.fire({
            title: '',
            width: 480,
            padding: '5em',
            background: '#fff url(http://localhost/apleonawaste_test/images/partyTime.gif)',
            backdrop: `
              rgba(0,0,123,0.4)
              url("http://localhost/apleonawaste_test/images/party.gif")
              center top
              no-repeat
            `
          })
    }

    function deletionConfirmation() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete files!'
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
            } else {
                return false;
            }
          })
    }

function confirmation(ev) {
    ev.preventDefault();
    var urlToRedirect = ev.currentTarget.getAttribute('href'); //use currentTarget because the click may be on the nested i tag and not a tag causing the href to be empty
    console.log(urlToRedirect); // verify if this is the right URL
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, confirm deletion!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Deleted!',
            'Your selection has been deleted.',
            'success'
          ).then(function() {
          window.location.replace(urlToRedirect);
          });
        } else {
            
        }
      });
}

</script>