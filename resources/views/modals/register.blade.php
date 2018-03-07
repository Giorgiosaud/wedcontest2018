<register inline-template >
    <modal name="register" height="auto" >
        <div>
        <form class="p-10" @submit.prevent="register">
            <div class="mb-6">
                <label for="name" class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">@lang('registration.name')</label>
                <input type="text" class="w-full p-2 leading-normal" id="name" autocomplete="name" name="name" autocomplete="name" placeholder="John Doe" value="{{ old('name') }}" required v-model="form.name" @keydown="errors.name = false">
                <span v-if="errors.name" v-text="errors.name[0]" class="text-xs text-red"></span>
            </div>

            <div class="mb-6">
                <label for="last_name" class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">@lang('registration.last_name')</label>
                <input type="text" class="w-full p-2 leading-normal" id="last_name" autocomplete="last_name" name="last_name" autocomplete="last_name" placeholder="johndoe" value="{{ old('last_name') }}" required v-model="form.last_name" @keydown="errors.last_name = false">
                <span v-if="errors.last_name" v-text="errors.last_name[0]" class="text-xs text-red"></span>
            </div>
            <div class="mb-6">
                <label for="phone" class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">@lang('registration.phone')</label>
                <input type="text" class="w-full p-2 leading-normal" id="phone" autocomplete="phone" name="phone" autocomplete="phone" placeholder="johndoe" value="{{ old('phone') }}" required v-model="form.phone" @keydown="errors.phone = false">
                <span v-if="errors.phone" v-text="errors.phone[0]" class="text-xs text-red"></span>
            </div>
            <div class="mb-6">
                <label for="country" class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">@lang('registration.country')</label>
               <v-select label="name" :options="{{$countries}}" v-model="country">
                   <template slot="option" slot-scope="option">
                       <span class="flag"><img :src="option.flag" alt=""></span>
                       @{{ option.name }}
                   </template>

               </v-select>
                <span v-if="errors.country" v-text="errors.country[0]" class="text-xs text-red"></span>
            </div>
            <div class="mb-6">
                <label for="email" class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">@lang('registration.email')</label>
                <input type="text" class="w-full p-2 leading-normal" id="email" autocomplete="email" name="email" autocomplete="email" placeholder="joe@example.com" value="{{ old('email') }}" required v-model="form.email" @keydown="errors.email = false">
                <div v-if="errors.email" v-text="errors.email[0]" class="text-xs text-red mt-2"></div>
            </div>

            <div class="mb-6">
                <label for="password" class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">@lang('registration.password')</label>
                <input type="password" class="w-full p-2 leading-normal" id="password" autocomplete="password" name="password" autocomplete="new-password" required v-model="form.password" @keydown="errors.password = false">
                <div v-if="errors.password" v-text="errors.password[0]" class="text-xs text-red mt-2"></div>
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">@lang('registration.password_confirmation')</label>
                <input type="password" class="w-full p-2 leading-normal" id="password_confirmation" autocomplete="password_confirmation" name="password_confirmation" autocomplete="new-password" required v-model="form.password_confirmation" @keydown="errors.password = false">
            </div>

            <div class="flex items-center -mx-4">
                <button type="submit" class="btn is-green flex-1 mx-4" :class="loading ? 'loader' : ''" :disabled="loading">@lang('registration.register')</button>
            </div>

            <div class="mt-6" v-if="feedback">
                <div class="text-xs text-red mt-2" v-text="feedback"></div>
            </div>
        </form>
        </div>
    </modal>
</register>
