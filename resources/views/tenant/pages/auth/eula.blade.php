
<form method="POST" action="{{ url('eula') }}">
    @csrf

    <div class="block mt-4">
        <label for="remember_me" class="flex items-center">
            <checkbox id="remember_me" name="remember" />
            <span class="ml-2 text-sm text-gray-600">This is the terms and conditions you must agree to before continuing.</span>
        </label>
    </div>

    <div class="flex items-center justify-end mt-4">
        <button class="ml-4 btn btn-primary">
            Agree
        </button>
    </div>
</form>
