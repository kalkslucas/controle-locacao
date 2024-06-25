document.addEventListener("DOMContentLoaded", function() {
  const rows = document.querySelectorAll("#tabelaAnexos tr");

  rows.forEach(row => {
      const img = row.querySelector(".preview img");
      if (img) {
          const fileName = img.getAttribute("src");
          if (fileName.endsWith(".pdf")) {
              const pdfIcon = document.createElement("div");
              pdfIcon.className = "pdf-icon";
              img.replaceWith(pdfIcon);
          } else {
              img.onerror = function() {
                  this.style.display = 'none';
                  // opcional: você pode adicionar um ícone genérico para arquivos quebrados aqui
              };
          }
      }
  });
});