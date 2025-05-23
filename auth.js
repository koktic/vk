export default function handler(req, res) {
  // Здесь можно добавить логику проверки токена
  res.status(200).json({ status: 'OK' });
}