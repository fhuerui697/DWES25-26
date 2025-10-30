# 🧭 Guía Completa de Programación Orientada a Objetos (OOP) en PHP

> 📘 Documentación didáctica y profesional sobre OOP en PHP, con ejemplos, ejercicios y mini‑proyecto.

## 📑 Contenidos principales
- 📄 **Guía completa en Markdown** → [Guia_Completa_PHP_OOP.md](Guia_Completa_PHP_OOP.md)
- 🌐 **Versión HTML interactiva** (índice lateral + copiar código) → [Guia_OOP_PHP.html](Guia_OOP_PHP.html)

## 🧱 Estructura
```
.
├── Guia_Completa_PHP_OOP.md
├── Guia_OOP_PHP.html
├── README.md
├── LICENSE
├── images/
├── docs/
│   └── index.md          # (para MkDocs)
├── mkdocs.yml            # (para publicar como web)
└── .github/workflows/mkdocs.yml  # (CI: build & deploy a gh-pages)
```

## 🚀 Verlo en GitHub
El archivo Markdown se renderiza automáticamente en GitHub:  
**→** `Guia_Completa_PHP_OOP.md`

## 🌐 Publicar como sitio con GitHub Pages (2 caminos)
### A) Rápido con rama `gh-pages`
1. Crea la rama y sube el HTML:
   ```bash
   git checkout -b gh-pages
   git add Guia_OOP_PHP.html
   git commit -m "Publicación HTML"
   git push origin gh-pages
   ```
2. En **Settings → Pages**, elige **Deploy from a branch → gh-pages / root**.

### B) Profesional con **MkDocs** (recomendado)
- Edita la guía en `docs/index.md`.
- GitHub Actions construye y despliega automáticamente a `gh-pages` con el workflow incluido.

## 🧰 Desarrollo local con MkDocs
```bash
pip install mkdocs
mkdocs serve
# abre http://127.0.0.1:8000/
```

## 🪪 Licencia
Este repositorio se distribuye bajo la licencia **MIT** (ver [LICENSE](LICENSE)).
