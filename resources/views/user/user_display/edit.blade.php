<!-- resources\views\user\user_display\edit.blade.php -->
<x-app-layout>
    <style>
        .container{
            margin: 1% 10% 0 10%;
        }
        h2 {
            color: #fff;
            font-size: 4ex;
            font-weight: 700;
        }
        .table {
            color: #fff;
        }
        .form-control {
            color: #7d7d7d;
        }
        .btn {
            display: inline-block;
            padding: 0.5em 1em;
            text-decoration: none;
            background: #668ad8;/*ボタン色*/
            color: #FFF;
            border-bottom: solid 4px #627295;
            border-radius: 3px;
        }
        .btn:active {
            /*ボタンを押したとき*/
            -webkit-transform: translateY(4px);
            transform: translateY(4px);/*下に動く*/
            box-shadow: 0px 0px 1px rgba(0, 0, 0, 0.2);/*影を小さく*/
            border-bottom: none;
        }
        .error {
            color: red;
        }
    </style>
    <div class="container mt-5">
        <h2>Edit User Information</h2>
        <form method="POST" action="{{  route('user_display.update', $user->id )}}">
            @csrf
            @method('PUT')
            <table class="table">
                <tbody>
                    <tr>
                        <th>User ID</th>
                        <td>
                            <input type="text" class="form-control" id="user_id" name="user_id" value="{{ $user->user_id }}" required>
                            <div id="user_id_error" class="error" style="display:none;">U can input only number</div>
                        </td>
                    </tr>
                    <tr>
                        <th>User Name</th>
                        <td>
                            <input type="text" class="form-control" id="user_name" name="user_name" value="{{  $user->name }}"required>
                        </td>
                    </tr>
                    <tr>
                        <th>Group Id</th>
                        <td>
                            <input type="text" class="form-control" id="group_id" name="group_id" value = "{{ $user->group_id }}" required>
                            <div id="group_id_error" class="error" style="display:none;">U can input only number</div>
                        </td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>
                            <input type="email" class="form-control" id="email" name="email" value= "{{ $user->email }}" required>
                            <div id="email_error" class="error" style="display:none; "> U can input only email syle</div>
                        </td>
                    </tr>
                </tbody>
            </table>
            @foreach ($errors->all() as $error)
                <li class="error">{{$error}}</li>
            @endforeach
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', function(){
        const userIdInput = document.getElementById('user_id');
        const userIdError = document.getElementById('user_id_error');

        userIdInput.addEventListener('input', function(){
            // 全角入力を半角に変換
            this.value = this.value.replace(/[０-９]/g,function(s){
                return String.formCharCode(s.charCodeAt(0) - 0xFEE0);
            });

            // 数字意外の文字が含まれている場合のエラーメッセージ
            if(this.value === '' || /[^0-9]/.test(this.value)){
                userIdError.style.display = 'block';
            } else {
                userIdError.style.display = 'none';
            }
        });
    });
    document.addEventListener('DOMContentLoaded', function(){
        const groupIdInput = document.getElementById('group_id');
        const groupIdError = document.getElementById('group_id_error');

        groupIdInput.addEventListener('input', function(){
            // 全角入力を半角に変換
            this.value = this.value.replace(/[０-９]/g,function(s){
                return String.fromCharCode(s.charCodeAt(0) - 0xFEE0);
            });

            // 数字意外の文字が含まれている場合のエラーメッセージ
            if(this.value === '' || /[^0-9]/.test(this.value)){
                groupIdError.style.display = 'block';
            } else {
                groupIdError.style.display = 'none';
            }
        });
    });
    document.addEventListener('DOMContentLoaded', function(){
        const emailInput = document.getElementById('email');
        const emailError = document.getElementById('email_error');

        emailInput.addEventListener('input', function() {
            // Validate email format
            if (!emailInput.value.match(/.+@.+\..+/)) {
                emailError.style.display = 'block';
            } else {
                emailError.style.display = 'none';
            }
        });
    });
</script>