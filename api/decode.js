export default function handler(req, res) {
    if (req.method !== "POST") {
        return res.status(405).json({ error: "Only POST allowed" });
    }

    try {
        const { data } = req.body;

        if (!data) {
            return res.status(400).json({ error: "Missing data" });
        }

        const decoded = Buffer.from(data, "base64").toString("utf-8");

        try {
            const json = JSON.parse(decoded);
            return res.json({ status: "success", decoded: json });
        } catch {
            return res.json({ status: "success", decoded });
        }
    } catch (e) {
        return res.status(500).json({ error: e.message });
    }
}
