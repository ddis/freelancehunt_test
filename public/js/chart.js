$().ready(() => {
    new Promise((resolve, rejected) => {
        $.ajax("/api/v1/charts/by-price", {
            method  : "GET",
            dataType: "JSON",
            success : (res) => {
                if (res.status === "success") {
                    resolve(res.data);
                } else {
                    rejected();
                }
            },
            error   : (res) => {
                rejected();
            }
        });
    }).then(resolve => {
        new Chart($("#chartByPrice"), {
            type: 'pie',
            data: {
                labels  : resolve.labels,
                datasets: [{
                    data           : resolve.values,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderWidth    : 1
                }]
            }
        });
    }).catch(rejected => {
    
    });
    
    
    new Promise((resolve, rejected) => {
        $.ajax("/api/v1/charts/top-skills", {
            method  : "GET",
            dataType: "JSON",
            success : (res) => {
                if (res.status === "success") {
                    resolve(res.data);
                } else {
                    rejected();
                }
            },
            error   : (res) => {
                rejected();
            }
        });
    }).then(resolve => {
        new Chart($("#chartBySkills"), {
            type: 'bar',
            data: {
                labels  : resolve.labels,
                datasets: [{
                    label: "Количество",
                    data           : resolve.values,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderWidth    : 1
                }]
            }
        });
    })
});