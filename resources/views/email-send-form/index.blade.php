@extends('layouts.app')

@section('content')
    <div class="container mt-3 align-content-center">
        <div class="w-50  border-2 p-2" style="margin:0px auto">
            <form id="email-send-form">
                @csrf <!-- {{ csrf_field() }} -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input id="email" type="email" class="form-control" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="email_text" class="form-label">Write Email</label>
                    <textarea  id="email_text" rows="5" class="form-control" name="email_text" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input id="date" name="date" type="date" class="form-control" required >
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@stop

@section('scripts')
<script>
    {{--window.addEventListener('DOMContentLoaded', (event) => {--}}
    {{--    let form = document.getElementById('email-send-form');--}}

    {{--    form.addEventListener('submit', (event) => {--}}
    {{--        event.preventDefault()--}}
    {{--        let xhr = new XMLHttpRequest();--}}
    {{--        xhr.open("POST", '{{route('mail.store')}}', true);--}}
    {{--        xhr.setRequestHeader('Content-type', 'application/json; charset=UTF-8');--}}
    {{--        xhr.setRequestHeader('X-CSRF-TOKEN', document.getElementsByName("_token")[0].value);--}}
    {{--        xhr.send(--}}
    {{--            JSON.stringify(Object.fromEntries(new FormData(form)))--}}
    {{--        );--}}
    {{--        xhr.onload = function(e) {--}}
    {{--            if (this.readyState === XMLHttpRequest.DONE && this.status === 201) {--}}
    {{--                var response = JSON.parse(xhr.responseText);--}}
    {{--                console.log(response);--}}
    {{--            }--}}
    {{--        }--}}
    {{--    });--}}

    {{--});--}}
    $(function () {
        $('#email-send-form').on('submit',function (e) {
            e.preventDefault()
            let form = $(this)
            Swal.showLoading()

            let data = new FormData(this);
            $.ajax({
                type:'POST',
                url:'{{route('mail.store')}}',
                dataType:'json',
                data:data,
                contentType: false,
                processData: false,
                success:function (response) {
                    Swal.fire(
                        'Success!',
                        'Email will be sent later!',
                        'success'
                    )
                    form.find('input,textarea').val('')
                },
                error:function (response) {
                    Swal.fire(
                        'Fail!',
                        'Failed to schedule email send',
                        'error'
                    )
                }
            })
        })

    })
</script>
@stop
