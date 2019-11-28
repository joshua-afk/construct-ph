<template>
	<section class="auth">
        <div class="auth__container auth__container--register">
            <div class="row">
                <div class="col-md-7">
                    <form method="post" action="/register">
                        <h2 class="auth__header">Create account</h2>
                        <div class="form__header-line"></div>

                        <input type="hidden" name="_token" :value="csrf">

                        <div class="form-group">
                            <select name="role" class="form-control select2">
                                <option value=""></option>
                                <option value="client">I'm a Client</option>
                                <option value="professional">I'm a Professional</option>
                                <option value="company">I'll Create a Company</option>
                            </select>
                        </div>

                        <div class="form-row form-group">
                            <div class="col">
                                <input type="text" class="form-control" name="first_name" placeholder="First Name">
                                <!-- <input type="text" class="form-control {{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" placeholder="First Name"> -->
                                <!-- @if ($errors->has('first_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                                @endif -->
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="last_name" placeholder="Last Name">
                                <!-- <input type="text" class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" placeholder="Last Name">
                                @if ($errors->has('last_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                                @endif -->
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="email" name="email" class="form-control" aria-describedby="emailHelp" placeholder="E-Mail">
                            <!-- <input type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" aria-describedby="emailHelp" placeholder="E-Mail">
                            @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @else
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            @endif -->
                        </div>

                        <div class="form-row form-group">
                            <div class="col">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                <!-- <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password">
                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif -->
                            </div>
                            <div class="col">
                                <input type="password" class="form-control" name="re-password" placeholder="Confirm Password">
                                <!-- <input type="password" class="form-control {{ $errors->has('re-password') ? ' is-invalid' : '' }}" name="re-password" placeholder="Confirm Password">
                                @if ($errors->has('re-password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('re-password') }}</strong>
                                </span>
                                @endif -->
                            </div>
                        </div>

                        <div class="form-group">
                            <datepicker
                                :format="customFormatter"
                                :initialView="'year'"
                                input-class="v-datepicker form-control"
                                name="birthdate"
                                placeholder="Birthdate"
                            ></datepicker>
                            <!-- <input class="form-control" aria-describedby="birthdateHelp" id="birthdate" name="birthdate" placeholder="Birth Date"> -->
                            <!-- <input class="form-control {{ $errors->has('birthdate') ? ' is-invalid' : ''}}" aria-describedby="birthdateHelp" id="birthdate" name="birthdate" placeholder="Birth Date">
                            @if ($errors->has('birthdate'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('birthdate') }}</strong>
                            </span>
                            @else
                            <small id="birthdateHelp" class="form-text text-muted">Your birthdate.</small>
                            @endif -->
                        </div>

                        <div class="form-group">
                            <input type="number" class="form-control" name="phone_number" placeholder="Phone Number (optional)" maxlength="11">
                            <!-- <input type="number" class="form-control {{ $errors->has('phone_number') ? ' is-invalid' : '' }}" id="datepicker" name="phone_number" placeholder="Phone Number (optional)" maxlength="11">
                            @if ($errors->has('phone_number'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phone_number') }}</strong>
                            </span>
                            @endif -->
                        </div>

                        <div class="row">
                            <div class="col auth__link">
                                <a href="/login">I have an account</a>
                            </div>
                            <div class="col auth__btn">
                                <button class="btn -submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-5 col-md-5--register">
                    <i class="flaticon-020-manufacture"></i>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import Datepicker from 'vuejs-datepicker';

export default {
    components: {
        Datepicker
    },
    props: [],
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        };
    },
    mounted(){
        $(".select2").select2({
            placeholder: "Who are you?",
            allowClear: true
        });
    },
    methods:{
        customFormatter(date) {
          return moment(date).format('YYYY/MM/DD');
      }
    }
}
</script>