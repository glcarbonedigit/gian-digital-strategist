<x-app-layout>
    <div style="padding: 48px 32px;">
        <div style="max-width: 1100px; margin: 0 auto;">
            <div style="margin-bottom: 32px;">
                <p style="margin:0 0 8px; text-transform:uppercase; letter-spacing:2px; font-size:12px; color:#777;">
                    Dashboard
                </p>
                <h1 style="margin:0; font-size:42px; line-height:1;">
                    Area riservata
                </h1>
            </div>

            <div style="display:grid; grid-template-columns:repeat(2, minmax(0, 1fr)); gap:20px;">
                <a href="{{ route('admin.projects') }}"
                   style="display:block; padding:24px; background:#fff; border:1px solid #ddd; border-radius:18px; text-decoration:none; color:#111;">
                    <strong style="display:block; font-size:22px; margin-bottom:10px;">Progetti</strong>
                    <span>Gestisci i case study e i progetti del portfolio.</span>
                </a>

                <a href="{{ route('admin.projects.create') }}"
                   style="display:block; padding:24px; background:#fff; border:1px solid #ddd; border-radius:18px; text-decoration:none; color:#111;">
                    <strong style="display:block; font-size:22px; margin-bottom:10px;">Nuovo progetto</strong>
                    <span>Crea un nuovo progetto con contenuti e immagine.</span>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>