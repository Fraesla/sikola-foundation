@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', () => {

    /*
    |--------------------------------------------------------------------------
    | Auto Hide Flash
    |--------------------------------------------------------------------------
    */

    const alerts = document.querySelectorAll(
        '.alert-auto-close'
    );

    alerts.forEach(alert => {

        setTimeout(() => {

            alert.classList.add(
                'opacity-0',
                'translate-y-2'
            );

            setTimeout(() => {

                alert.remove();

            },300);

        },4000);

    });

});


/*
|--------------------------------------------------------------------------
| Confirm Action
|--------------------------------------------------------------------------
*/

document.querySelectorAll('.btn-confirm')
.forEach(button=>{

    button.addEventListener('click',function(e){

        if(!confirm(this.dataset.message)){

            e.preventDefault();

        }

    });

});

</script>

@endpush