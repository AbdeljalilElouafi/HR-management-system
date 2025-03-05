@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Organigramme</h1>
    <div id="chart-container" class="orgchart"></div>
</div>

<script>
    $(document).ready(function () {
        // Convert the PHP data to a format that OrgChart.js can use
        const employees = @json($employees);

        // Build the hierarchical structure
        const buildHierarchy = (employees) => {
            const map = {};
            const roots = [];

            employees.forEach(employee => {
                map[employee.id] = { ...employee, children: [] };
            });

            employees.forEach(employee => {
                if (employee.parentId) {
                    map[employee.parentId].children.push(map[employee.id]);
                } else {
                    roots.push(map[employee.id]);
                }
            });

            return roots;
        };

        const hierarchy = buildHierarchy(employees);

        // Initialize the organization chart
        $('#chart-container').orgchart({
            data: hierarchy[0], // The root of the hierarchy
            nodeContent: 'title', // Display the employee's title
            nodeId: 'id', // Unique identifier for each node
            parentNodeSymbol: 'fa-users', // Icon for parent nodes
            createNode: function ($node, data) {
                // Customize the node content
                $node.append(`<div class="title">${data.name}</div>`);
                $node.append(`<div class="content">${data.title}</div>`);
            }
        });
    });
</script>
@endsection