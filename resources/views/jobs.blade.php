<x-layout>
    <x-slot:heading>
        Jobs page
    </x-slot:heading>

    <div class="space-y-4">
        @foreach ($jobs as $job)
            <a href="/jobs/{{ $job['id'] }}" class="block px-4 py-6 border border-gray-200">
                <div class="font-bold text-blue-500">{{  $job->employer->name }}</div>
                
                <strong>
                    {{ $job['title'] }}:
                </strong> 
                Pays {{ $job['salary'] }} per year
            </a>
        @endforeach
    </div>
</x-layout>