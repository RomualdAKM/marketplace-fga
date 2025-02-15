<template>
    
    <div  class="col-span-6 flex flex-col items-center justify-end sm:col-span-3 xl:col-span-2">
                    <span class="h-8 w-8">
                        <svg class="h-full w-full" width="20" viewBox="0 0 57 57" xmlns="http://www.w3.org/2000/svg">
                            <g fill="none" fill-rule="evenodd">
                                <g transform="translate(1 1)">
                                    <circle cx="5" cy="50" r="5" fill="#2d3748">
                                        <animate values="50;5;50;50" attributeName="cy" begin="0s" dur="2.2s" calcMode="linear" repeatCount="indefinite" />
                                        <animate values="5;27;49;5" attributeName="cx" begin="0s" dur="2.2s" calcMode="linear" repeatCount="indefinite" />
                                    </circle>
                                    <circle cx="27" cy="5" r="5" fill="#2d3748">
                                        <animate values="5;50;50;5" attributeName="cy" begin="0s" dur="2.2s" from="5" to="5" calcMode="linear" repeatCount="indefinite" />
                                        <animate values="27;49;5;27" attributeName="cx" begin="0s" dur="2.2s" from="27" to="27" calcMode="linear" repeatCount="indefinite" />
                                    </circle>
                                    <circle cx="49" cy="50" r="5" fill="#2d3748">
                                        <animate values="50;50;5;50" attributeName="cy" begin="0s" dur="2.2s" calcMode="linear" repeatCount="indefinite" />
                                        <animate values="49;5;27;49" attributeName="cx" from="49" to="49" begin="0s" dur="2.2s" calcMode="linear" repeatCount="indefinite" />
                                    </circle>
                                </g>
                            </g>
                        </svg>
                    </span>
                    <!-- <div class="mt-2 text-center text-xs">
                        ball-triangle
                    </div> -->
                </div>
</template>