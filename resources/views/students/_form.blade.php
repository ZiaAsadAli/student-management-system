{{-- Name --}}
<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
    <input type="text" name="name" value="{{ old('name', $student->name ?? '') }}"
           class="w-full border rounded-lg px-3 py-2 @error('name') border-red-500 @enderror">
    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
</div>

{{-- Email --}}
<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Email Address *</label>
    <input type="email" name="email" value="{{ old('email', $student->email ?? '') }}"
           class="w-full border rounded-lg px-3 py-2 @error('email') border-red-500 @enderror">
    @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
</div>

{{-- Phone --}}
<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Phone *</label>
    <input type="text" name="phone" value="{{ old('phone', $student->phone ?? '') }}"
           class="w-full border rounded-lg px-3 py-2 @error('phone') border-red-500 @enderror">
    @error('phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
</div>

{{-- Program --}}
<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Program *</label>
    <select name="program" class="w-full border rounded-lg px-3 py-2 @error('program') border-red-500 @enderror">
        <option value="">Select Program</option>
        @foreach(['Master of Computer Science', 'Master of Business Administration', 'Master of Data Science', 'Master of Engineering', 'Master of Education'] as $prog)
            <option value="{{ $prog }}" {{ old('program', $student->program ?? '') === $prog ? 'selected' : '' }}>
                {{ $prog }}
            </option>
        @endforeach
    </select>
    @error('program')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
</div>

{{-- GPA --}}
<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">GPA (0.0 – 4.0) *</label>
    <input type="number" step="0.01" min="0" max="4" name="gpa"
           value="{{ old('gpa', $student->gpa ?? '') }}"
           class="w-full border rounded-lg px-3 py-2 @error('gpa') border-red-500 @enderror">
    @error('gpa')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
</div>

{{-- Gender --}}
<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Gender *</label>
    <select name="gender" class="w-full border rounded-lg px-3 py-2 @error('gender') border-red-500 @enderror">
        <option value="">Select Gender</option>
        @foreach(['male' => 'Male', 'female' => 'Female', 'other' => 'Other'] as $val => $label)
            <option value="{{ $val }}" {{ old('gender', $student->gender ?? '') === $val ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
    @error('gender')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
</div>

{{-- Date of Birth --}}
<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">
        Date of Birth * <span class="text-gray-400 text-xs">(must be 18+ years old)</span>
    </label>
    <input type="date" name="date_of_birth"
           max="{{ now()->subYears(18)->format('Y-m-d') }}"
           value="{{ old('date_of_birth', isset($student) ? optional($student->date_of_birth)->format('Y-m-d') : '') }}"
           class="w-full border rounded-lg px-3 py-2 @error('date_of_birth') border-red-500 @enderror">
    @error('date_of_birth')
        <p class="text-red-500 text-xs mt-1">Student must be at least 18 years old.</p>
    @enderror
</div>

{{-- Status --}}
<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Admission Status *</label>
    <select name="status" class="w-full border rounded-lg px-3 py-2 @error('status') border-red-500 @enderror">
        @foreach(['pending' => 'Pending', 'admitted' => 'Admitted', 'rejected' => 'Rejected'] as $val => $label)
            <option value="{{ $val }}" {{ old('status', $student->status ?? 'pending') === $val ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
    @error('status')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
</div>

{{-- Address --}}
<div class="md:col-span-2">
    <label class="block text-sm font-medium text-gray-700 mb-1">Address *</label>
    <textarea name="address" rows="3"
              class="w-full border rounded-lg px-3 py-2 @error('address') border-red-500 @enderror">{{ old('address', $student->address ?? '') }}</textarea>
    @error('address')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
</div>