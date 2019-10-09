<html>
<head>
    <link href="//cdnjs.cloudflare.com/ajax/libs/foundation/6.3.1/css/foundation.min.css" rel="stylesheet" id="bootstrap-css">
    <style>

        .error_txt{margin-bottom: 10px; display: block; color: #f00; font-size: 13px;}

        .foundation-example__ex-wrapper{
            background-color: #fff7ee;
        }
        .foundation-example__in-wrapper{
            margin: auto;
            max-width: 800px;
            background: #fff7ee;
            padding: 30px;
        }

        .foundation-example__title{
            font-size: 40px;
            margin-bottom: 25px;
        }

    </style>
</head>

<body>
<section id="app">
    <div style="height: 20px;background: dimgray;"></div>
    <div class="foundation-example__ex-wrapper">
        <div class="foundation-example__in-wrapper">
            <div class="foundation-example__title"> お問い合わせ</div>
            <form v-if="!emailSent">
                <div class="row">
                    <div class="large-6 columns">
                        <label>姓
                            <input type="text" v-model="lastName">
                            <div class="error_txt" v-html="errors.last_name"></div>
                        </label>
                        <label>メールアドレス
                            <input type="text" v-model="email">
                            <div class="error_txt" v-html="errors.email"></div>
                        </label>
                    </div>

                    <div class="large-6 columns">
                        <label>名
                            <input type="text" v-model="firstName">
                            <div class="error_txt" v-html="errors.first_name"></div>
                        </label>
                        <label>ご用件
                            <select v-model="subjectId">
                                <option value=""></option>
                                <option v-for="(subject,id) in subjects" :value="id" v-text="subject"></option>
                            </select>
                            <div class="error_txt" v-html="errors.subject_id"></div>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="large-12 columns">
                        <label>お問い合わせ内容
                            <textarea rows="10" placeholder="お問い合わせの内容をご入力ください。" v-model="body"></textarea>
                            <div class="error_txt" v-html="errors.body"></div>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="large-12 columns text-center">
                        <button class="button expanded" type="button" @click="onSubmit()">送信する</button>
                    </div>
                </div>
            </form>
            <div v-if="emailSent">メッセージが送信されました。ありがとうございました。</div>
        </div>
    </div>
    <div style="height: 20px;background: dimgray;"></div>
</section>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
<script>

    new Vue({
        el: '#app',
        data: {
            firstName: '',
            lastName: '',
            email: '',
            subjectId: '',
            body: '',
            subjects: {!! \App\EmailSubject::all() !!},
            emailSent: false,
            errors: {}
        },
        methods: {
            onSubmit: function() {

                if(!confirm('送信します。よろしいですか？')) {

                    return;

                }

                this.errors = {};
                var self = this;
                var params = {
                    first_name: this.firstName,
                    last_name: this.lastName,
                    email: this.email,
                    subject_id: this.subjectId,
                    body: this.body
                };
                axios.post('/contact', params)
                    .then(function(){

                        self.emailSent = true;

                    })
                    .catch(function(error){

                        var errors = {};

                        for(var key in error.response.data.errors) {

                            errors[key] = error.response.data.errors[key].join('<br>');

                        }

                        self.errors = errors;

                    });

            }
        }
    });

</script>
</body>
</html>
