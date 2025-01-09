@php
    $statuses = ['pending' => 1, 'accepted' => 2, 'processing' => 3, 'shipped' => 4, 'delivered' => 5];
    $currentStep = $statuses[$order->order_status] ?? 1;
@endphp

<div class="max-w-4xl flex items-center justify-between w-[190%]">
    <!-- Step 1 -->
    <div class="step-container">
        <div id="step1" class="step w-10 h-10 flex items-center justify-center rounded-full step-pending">1</div>
        <div class="step-status" id="status1">Pending</div>
    </div>
    <!-- Line 1 -->
    <div class="step-container">
        <div id="line1" class="progress-line"></div>
    </div>
    <!-- Step 2 -->
    <div class="step-container">
        <div id="step2" class="step w-10 h-10 flex items-center justify-center rounded-full step-pending">2</div>
        <div class="step-status" id="status2">Accepted</div>
    </div>
    <!-- Line 2 -->
    <div class="step-container">
        <div id="line2" class="progress-line w-0"></div>
    </div>
    <!-- Step 3 -->
    <div class="step-container">
        <div id="step3" class="step w-10 h-10 flex items-center justify-center rounded-full step-pending">3</div>
        <div class="step-status" id="status3">Processing</div>
    </div>
    <!-- Line 3 -->
    <div class="step-container">
        <div id="line3" class="progress-line w-0"></div>
    </div>
    <!-- Step 4 -->
    <div class="step-container">
        <div id="step4" class="step w-10 h-10 flex items-center justify-center rounded-full step-pending">4</div>
        <div class="step-status" id="status4">Shipped</div>
    </div>
    <!-- Line 4 -->
    <div class="step-container">
        <div id="line4" class="progress-line w-0"></div>
    </div>
    <!-- Step 5 -->
    <div class="step-container">
        <div id="step5" class="step w-10 h-10 flex items-center justify-center rounded-full step-pending">5</div>
        <div class="step-status" id="status5">Delivered</div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        updateProgress("{{ $currentStep }}");
    });

    function updateProgress(step) {
        // Reset all steps and lines
        for (let i = 1; i <= 5; i++) {
            const stepElement = document.getElementById(`step${i}`);
            const lineElement = document.getElementById(`line${i}`);
            const statusElement = document.getElementById(`status${i}`);

            // Reset step
            stepElement.classList.remove("step-completed");
            stepElement.classList.add("step-pending");
            stepElement.textContent = i; 

            // Reset line
            if (lineElement) {
                lineElement.style.width = "300%"; 
                lineElement.classList.remove("progress-line-completed");
            }

            // Reset status
            statusElement.textContent = ["Pending", "Accepted", "Processing", "Shipped", "Delivered"][i - 1];
        }

        // Update completed steps and lines
        for (let i = 1; i <= step; i++) {
            const stepElement = document.getElementById(`step${i}`);
            const lineElement = document.getElementById(`line${i - 1}`);
            const statusElement = document.getElementById(`status${i}`);

            // Mark step as completed
            stepElement.classList.add("step-completed");
            stepElement.classList.remove("step-pending");
            stepElement.innerHTML = "✓"; 

            // Expand line to connect to the next step
            if (lineElement) {
                lineElement.classList.add("progress-line-completed");
            }

            // Update status
            statusElement.textContent = ["Pending", "Accepted", "Processing", "Shipped", "Delivered"][i - 1];
        }
    }

</script>