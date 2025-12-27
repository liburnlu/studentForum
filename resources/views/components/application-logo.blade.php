<svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" {{$attributes}}>
    <!-- Background circle -->
    <circle cx="100" cy="100" r="95" fill="#4F46E5" />

    <!-- Speech bubble -->
    <path d="M 60 70 L 140 70 Q 150 70 150 80 L 150 110 Q 150 120 140 120 L 90 120 L 75 135 L 75 120 L 60 120 Q 50 120 50 110 L 50 80 Q 50 70 60 70 Z"
          fill="white" />

    <!-- Graduation cap on speech bubble -->
    <g transform="translate(100, 90)">
        <!-- Cap top -->
        <rect x="-40" y="-16" width="80" height="5" fill="#4F46E5" />
        <!-- Cap base -->
        <path d="M -30 -11 L 30 -11 L 25 4 L -25 4 Z" fill="#4F46E5" />
        <!-- Tassel -->
        <line x1="40" y1="-16" x2="48" y2="0" stroke="#FCD34D" stroke-width="2.5" />
        <circle cx="48" cy="1" r="4" fill="#FCD34D" />
    </g>
</svg>
